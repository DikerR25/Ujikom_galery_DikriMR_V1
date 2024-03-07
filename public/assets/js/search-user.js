
document.addEventListener('DOMContentLoaded', function () {
    var users = document.querySelectorAll('.user');
    var searchInput = document.getElementById('searchInput');
    var searchForm = document.getElementById('searchForm');
    var userList = document.getElementById('userList');
    var searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('keyup', function () {
        var searchTerm = searchInput.value.toLowerCase();
        var filteredUsers = [];

        users.forEach(function (user) {
            var username = user.textContent.toLowerCase();
            if (username.includes(searchTerm)) {
                filteredUsers.push(user.textContent);
            }
        });

        if (searchTerm.length === 0) {
            userList.style.display = 'none';
            searchResults.style.display = 'none';
        } else {
            userList.style.display = 'block';
            searchResults.style.display = 'block';
        }

        // Menampilkan hasil pencarian dalam dropdown
        var searchResultsHTML = filteredUsers.map(function (user) {
            return '<li style="list-style-type: none;">' + user + '</li>';
        }).join('');
        searchResults.innerHTML = searchResultsHTML;
    });

    // Menangani klik pada hasil pencarian
    searchResults.addEventListener('click', function (e) {
        if (e.target.tagName === 'LI') {
            var username = e.target.textContent;
            var profileURL = '/profile/' + username;
            searchForm.action = profileURL;
            searchInput.value = username;
            userList.style.display = 'none';
            searchResults.style.display = 'none';
        }
    });
});
