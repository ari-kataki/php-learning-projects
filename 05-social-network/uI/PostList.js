import { View, Text, StyleSheet } from 'react-native';

export default function PostList({ posts }) {
  return (
    <View>
      {posts.map((post) => (
        <View key={post.id} style={styles.post}>
          <Text style={styles.username}>{post.username}</Text>
          <Text style={styles.content}>{post.content}</Text>
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
  username: {
    fontSize: 14,
    fontWeight: 'bold',
    color: '#333',
    marginBottom: 6,
  },
  content: {
    fontSize: 14,
    color: '#555',
    lineHeight: 18,
  },
});
