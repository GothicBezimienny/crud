const users = document.getElementById('users');
if (users) {
  users.addEventListener('click', e => {
    if (e.target.className === 'btn btn-dark delete-article') {
        const id = e.target.getAttribute('data-id');
        fetch(`/delete/${id}`, {method: 'DELETE'}).then(res => window.location.reload());
      
    }
  });
}

