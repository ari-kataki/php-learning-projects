import { StatusBar } from 'expo-status-bar';
import { StyleSheet, Text, View, ScrollView } from 'react-native';
import { useState } from 'react';
import PostForm from './uI/PostForm';
import PostList from './uI/PostList';

export default function App() {
  const [posts, setPosts] = useState([
    { id: 1, username: 'John', content: 'Hello everyone!' },
    { id: 2, username: 'Jane', content: 'This is a test post' },
  ]);

  const handleAddPost = (text) => {
    const newPost = {
      id: posts.length + 1,
      username: 'You',
      content: text,
    };
    setPosts([newPost, ...posts]);
  };

  return (
    <ScrollView style={styles.container}>
      <Text style={styles.title}>MeowingCats</Text>

      <PostForm onAddPost={handleAddPost} />
      <PostList posts={posts} />

      <StatusBar style="auto" />
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f5f5f5',
    padding: 12,
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    textAlign: 'center',
    color: '#9078d7',
    marginBottom: 20,
    marginTop: 20,
  },
});
