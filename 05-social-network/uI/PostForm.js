import { StyleSheet, TextInput, TouchableOpacity, Text, View } from 'react-native';
import { useState } from 'react';

export default function PostForm({ onAddPost }) {
  const [text, setText] = useState('');

  const handlePress = () => {
    if (text.trim()) {
      onAddPost(text);
      setText('');
    }
  };

  return (
    <View style={styles.container}>
      <TextInput
        style={styles.input}
        placeholder="Write here"
        value={text}
        onChangeText={setText}
      />
      <TouchableOpacity style={styles.button} onPress={handlePress}>
        <Text style={styles.buttonText}>Post</Text>
      </TouchableOpacity>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flexDirection: 'row',
    gap: 8,
    marginBottom: 16,
    backgroundColor: 'white',
    padding: 10,
    borderRadius: 8,
  },
  input: {
    flex: 1,
    borderWidth: 1,
    borderColor: '#ddd',
    borderRadius: 6,
    paddingHorizontal: 10,
    fontSize: 14,
  },
  button: {
    backgroundColor: '#9078d7',
    paddingHorizontal: 16,
    borderRadius: 6,
    justifyContent: 'center',
  },
  buttonText: {
    color: 'white',
    fontSize: 14,
    fontWeight: 'bold',
  },
});
