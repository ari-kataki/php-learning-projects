import React, { useState } from 'react';

const PostForm = ({ onPostCreated }) => {
  const [message, setMessage] = useState('');
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!message.trim()) return;

    setLoading(true);
    try {
      const response = await fetch('/api/posts', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ content: message }),
      });
      if (response.ok) {
        setMessage('');
        onPostCreated();
      }
    } catch (err) {
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  return (
    <form onSubmit={handleSubmit} className="post-form">
      <input
        type="text"
        placeholder="Write here"
        value={message}
        onChange={(e) => setMessage(e.target.value)}
        disabled={loading}
      />
      <button type="submit" disabled={loading}>Post</button>
    </form>
  );
};

export default PostForm;
