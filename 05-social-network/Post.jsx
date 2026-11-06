import React, { useState } from 'react';

const Post = ({ post, userAccess, onAction }) => {
  const [action, setAction] = useState(null);
  const [editText, setEditText] = useState(post.content);
  const [loading, setLoading] = useState(false);

  const canModify = userAccess === 'moderator' || userAccess === 'superadmin';
  const canDelete = userAccess === 'superadmin';

  const handleModify = async () => {
    if (!editText.trim()) return;
    setLoading(true);
    try {
      const response = await fetch(`/api/posts/${post.id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ content: editText }),
      });
      if (response.ok) {
        setAction(null);
        onAction();
      }
    } catch (err) {
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  const handleDelete = async () => {
    setLoading(true);
    try {
      const response = await fetch(`/api/posts/${post.id}`, { method: 'DELETE' });
      if (response.ok) {
        onAction();
      }
    } catch (err) {
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="post">
      <div className="post-header">
        <strong>{post.username}</strong>
        <small>{new Date(post.creation_date).toLocaleDateString()}</small>
      </div>
      <p>{post.content}</p>

      {action === 'modify' && canModify ? (
        <div className="action-form">
          <input
            type="text"
            value={editText}
            onChange={(e) => setEditText(e.target.value)}
            disabled={loading}
          />
          <button onClick={handleModify} disabled={loading}>Save</button>
          <button onClick={() => setAction(null)}>Cancel</button>
        </div>
      ) : (
        <div className="post-actions">
          {canModify && <button onClick={() => setAction('modify')} disabled={loading}>Modify</button>}
          {canDelete && <button onClick={handleDelete} disabled={loading}>Delete</button>}
        </div>
      )}
    </div>
  );
};

export default Post;
