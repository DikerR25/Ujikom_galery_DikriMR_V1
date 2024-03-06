function toggleLike(postId, userId) {
    fetch('/like', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            user_id: userId,
            post_id: postId
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Gagal melakukan like');
        }
        return response.json();
    })
    .then(data => {
        console.log(data.message);

        setTimeout(function() {
            location.reload();
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
