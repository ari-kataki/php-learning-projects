import React, { useState, useEffect } from 'react';
import Post from './Post';
import PostForm from './PostForm';
import './styles.css';

const SocialNetwork = () => {
  const [posts, setPosts] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [totalPages, setTotalPages] = useState(1);
  const [username, setUsername] = useState('');
  const [userAccess, setUserAccess] = useState('');

  const postsPerPage = 5;

  useEffect(() => {
    fetchUserData();
    fetchPosts();
  }, [currentPage]);

  const fetchUserData = async () => {
    try {
      const response = await fetch('/api/user');
      const data = await response.json();
      setUsername(data.username);
      setUserAccess(data.access);
    } catch (err) {
      console.error(err);
    }
  };

  const fetchPosts = async () => {
    try {
      const response = await fetch(`/api/posts?page=${currentPage}&limit=${postsPerPage}`);
      const data = await response.json();
      setPosts(data.posts);
      setTotalPages(data.totalPages);
    } catch (err) {
      console.error(err);
    }
  };

  return (
    <div className="container">
      <div className="header">
        <span>{username}</span>
        <button onClick={() => window.location.href = '/logout'}>Logout</button>
      </div>

      <h1>MeowingCats</h1>

      <PostForm onPostCreated={() => { setCurrentPage(1); fetchPosts(); }} />

      <div className="posts">
        {posts.map((post) => (
          <Post
            key={post.id}
            post={post}
            userAccess={userAccess}
            onAction={() => fetchPosts()}
          />
        ))}
      </div>

      <div className="pagination">
        {currentPage > 1 && <button onClick={() => setCurrentPage(currentPage - 1)}>Back</button>}
        <span>{currentPage} / {totalPages}</span>
        {currentPage < totalPages && <button onClick={() => setCurrentPage(currentPage + 1)}>Next</button>}
      </div>
    </div>
  );
};

export default SocialNetwork;
