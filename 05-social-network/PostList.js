import React, { useState } from 'react';
import {
  View,
  Text,
  StyleSheet,
  TouchableOpacity,
  TextInput,
  Alert,
  ActivityIndicator,
} from 'react-native';

export default function PostList({ posts, userAccess, onModified, onDeleted }) {
  const [editingId, setEditingId] = useState(null);
  const [editText, setEditText] = useState('');
  const [loading, setLoading] = useState(false);

  const canModify = userAccess === 'moderator' || userAccess === 'superadmin';
  const canDelete = userAccess === 'superadmin';

  const handleModify = async (postId, currentContent) => {
    if (editingId === postId) {
      // Save mode
      if (!editText.trim()) {
        Alert.alert('Error', 'Post cannot be empty');
        return;
      }

      setLoading(true);
      try {
        const response = await fetch(`http://localhost/api/posts/${postId}`, {
          method: 'PUT',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ content: editText }),
        });

        if (response.ok) {
          setEditingId(null);
          setEditText('');
          onModified();
        } else {
          Alert.alert('Error', 'Failed to modify post');
        }
      } catch (err) {
        console.error('Error modifying post:', err);
        Alert.alert('Error', 'Network error');
      } finally {
        setLoading(false);
      }
    } else {
      // Edit mode
      setEditingId(postId);
      setEditText(currentContent);
    }
  };

  const handleDelete = (postId) => {
    Alert.alert('Delete Post', 'Are you sure?', [
      { text: 'Cancel', style: 'cancel' },
      {
        text: 'Delete',
        style: 'destructive',
        onPress: async () => {
          setLoading(true);
          try {
            const response = await fetch(`http://localhost/api/posts/${postId}`, {
              method: 'DELETE',
            });

            if (response.ok) {
              onDeleted();
            } else {
              Alert.alert('Error', 'Failed to delete post');
            }
          } catch (err) {
            console.error('Error deleting post:', err);
            Alert.alert('Error', 'Network error');
          } finally {
            setLoading(false);
          }
        },
      },
    ]);
  };

  const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString();
  };

  return (
    <View>
      {posts.map((post) => (
        <View key={post.id} style={styles.post}>
          <View style={styles.postHeader}>
            <Text style={styles.username}>{post.username}</Text>
            <Text style={styles.date}>{formatDate(post.creation_date)}</Text>
          </View>

          {editingId === post.id ? (
            <TextInput
              style={styles.editInput}
              multiline
              value={editText}
              onChangeText={setEditText}
              editable={!loading}
            />
          ) : (
            <Text style={styles.content}>{post.content}</Text>
          )}

          <View style={styles.actions}>
            {canModify && (
              <TouchableOpacity
                style={[styles.actionBtn, styles.modifyBtn]}
                onPress={() => handleModify(post.id, post.content)}
                disabled={loading}
              >
                {loading && editingId === post.id ? (
                  <ActivityIndicator size="small" color="white" />
                ) : (
                  <Text style={styles.actionBtnText}>
                    {editingId === post.id ? 'Save' : 'Modify'}
                  </Text>
                )}
              </TouchableOpacity>
            )}

            {editingId === post.id && (
              <TouchableOpacity
                style={[styles.actionBtn, styles.cancelBtn]}
                onPress={() => {
                  setEditingId(null);
                  setEditText('');
                }}
                disabled={loading}
              >
                <Text style={styles.actionBtnText}>Cancel</Text>
              </TouchableOpacity>
            )}

            {canDelete && editingId !== post.id && (
              <TouchableOpacity
                style={[styles.actionBtn, styles.deleteBtn]}
                onPress={() => handleDelete(post.id)}
                disabled={loading}
              >
                {loading ? (
                  <ActivityIndicator size="small" color="white" />
                ) : (
                  <Text style={styles.actionBtnText}>Delete</Text>
                )}
              </TouchableOpacity>
            )}
          </View>
        </View>
      ))}
    </View>
  );
}

const styles = StyleSheet.create({
  post: {
    backgroundColor: 'white',
    borderRadius: 8,
    padding: 12,
    marginBottom: 10,
    borderWidth: 1,
    borderColor: '#eee',
  },
  postHeader: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 8,
  },
  username: {
    fontSize: 13,
    fontWeight: 'bold',
    color: '#333',
  },
  date: {
    fontSize: 11,
    color: '#999',
  },
  content: {
    fontSize: 13,
    lineHeight: 18,
    color: '#333',
    marginBottom: 10,
  },
  editInput: {
    borderWidth: 1,
    borderColor: '#ddd',
    borderRadius: 6,
    padding: 8,
    fontSize: 12,
    marginBottom: 10,
    minHeight: 60,
  },
  actions: {
    flexDirection: 'row',
    gap: 6,
    flexWrap: 'wrap',
  },
  actionBtn: {
    paddingHorizontal: 10,
    paddingVertical: 6,
    borderRadius: 6,
    alignItems: 'center',
    justifyContent: 'center',
  },
  modifyBtn: {
    backgroundColor: '#ffc107',
  },
  deleteBtn: {
    backgroundColor: '#dc3545',
  },
  cancelBtn: {
    backgroundColor: '#6c757d',
  },
  actionBtnText: {
    color: 'white',
    fontSize: 11,
    fontWeight: 'bold',
  },
});
