document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const token = document.querySelector('meta[name="crsf-token"').getAttribute('content');

        if(!confirm('Are you sure you want to delete your timecapsule?')) return;

        fetch(`/timecapsule/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            }
        })
        .then(respone => respone.json())
        .then(data => {
            if (data.success) {
                const capsuleElement = document.getElementById(`capsule-${id}`);
                if (capsuleElement) capsuleElement.remove();
            } else {
                console.error('Error:' + data.message);
            }
        })
        .catch(error => {
            console.error('AJAX error:', error);
        });
    });
});