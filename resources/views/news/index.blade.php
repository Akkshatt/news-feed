<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Feed</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>

@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Caveat:wght@400..700&display=swap');
           :root {
            --primary-color: #001f3f;
            --secondary-color: #f2f2f2;
            --background-color: #ffffff;
            --text-color: #212529;
            --table-header-bg: #f8f9fa;
            --table-border-color: #dee2e6;
        }

        [data-theme="dark"] {
            --primary-color: #001f3f;
            --secondary-color: #444444;
            --background-color: #222222;
            --text-color: #dddddd;
            --table-header-bg: #333333;
            --table-border-color: #444444;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: "Bebas Neue", sans-serif;
        }

        .container {
    margin-top: 20px;
    margin-bottom: 20px;
    position: relative; /* Ensure relative positioning for child elements */
    min-height: calc(100vh - 100px); /* Adjust this based on your footer and navbar height */
    padding-bottom: 80px; /* Ensure space for footer and some extra */
}

        .table {
            border: 1px solid var(--table-border-color);
        }

        .table thead th {
            background-color: var(--table-header-bg);

      
            font-weight: bold;
        }
        

        .table-hover tbody tr:hover {
            background-color: var(--primary-color);
            color: var(--background-color);
        }

        .description {
            max-width: 400px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sortable {
            cursor: pointer;
            font-weight: bold;
        }

        .sorting-icon {
            margin-left: 5px;
            transition: transform 0.3s ease;
        }

        .theme-toggle {
            cursor: pointer;
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: var(--primary-color);
            color: var(--background-color);
            padding: 10px;
            border-radius: 50%;
            border: none;}


            .navbar {
            background-color: var(--primary-color);
            font-family: "Caveat", cursive;
  font-optical-sizing: auto
        }

        .navbar-brand {
            color: var(--secondary-color);
            font-weight: bold;
            font-size: 1.5rem;
        }
        .search-bar {
            max-width: 300px;
            margin: 10px 0;
        }

        footer {
    background-color: var(--primary-color);
    color: var(--secondary-color);
    padding: 10px 0;
    text-align: center;
    position: fixed;
    bottom: 0;
    width: 100%;
}


        footer a {
            color: var(--secondary-color);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
        .pagination {
    position: absolute;
    bottom: 35px; /* Adjust this to give proper spacing */
    left: 50%;
    transform: translateX(-50%);
    width: auto; /* Ensures it only takes the necessary width */
}
        
    </style>
</head>
<body data-theme="light">


<nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Akshat's NeWs</a>
    </nav>
    <div class="container">
        <!-- <h1 class="text-center">News Feed</h1> -->
        <button class="theme-toggle" onclick="toggleTheme()">&#x1F319;</button>
        <input type="text" id="search" class="form-control search-bar" placeholder="Search news...">
        <table class="table table-bordered table-hover mt-3">
            <thead class="thead-light">
                <tr>
                    <th class="sortable" onclick="sortTable(0)">Title <i class="fas sorting-icon fa fa-sort" id="title-icon"></i></th>
                    <th>Description</th>
                    <th>Link</th>
                    <th class="sortable" onclick="sortTable(3)">Published Date <i class="fas sorting-icon fa fa-sort" id="date-icon"></i></th>
                </tr>
            </thead>
            <tbody id="newsTable">
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item['title'] }}</td>
                        <td class="description">{{ strip_tags($item['description']) }}</td>
                        <td><a href="{{ $item['link'] }}" target="_blank">View</a></td>
                        <td>{{ date('d-m-Y', strtotime($item['pubDate'])) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav>
            <ul class="pagination justify-content-center">
            </ul>
        </nav>
    </div>



    <footer>
        <p>&copy; 2024 Akshat. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>


    <script>
        let asc = true;

        function sortTable(n) {
            const table = document.querySelector('table');
            const rows = Array.from(table.rows).slice(1);
            const icon = n === 0 ? document.getElementById('title-icon') : document.getElementById('date-icon');
            asc = !asc;

            rows.sort((row1, row2) => {
                const cell1 = row1.cells[n].innerText;
                const cell2 = row2.cells[n].innerText;
                return (cell1 === cell2 ? 0 : cell1 > cell2 ? 1 : -1) * (asc ? 1 : -1);
            });

            rows.forEach(row => table.appendChild(row));
            document.querySelectorAll('.sorting-icon').forEach(icon => {
                icon.className = 'fas sorting-icon';
            });
            icon.classList.add(asc ? 'fa-sort-up' : 'fa-sort-down');
        }

        document.getElementById('search').addEventListener('keyup', function () {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('#newsTable tr');
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const match = Array.from(cells).some(cell => cell.innerText.toLowerCase().includes(searchText));
                row.style.display = match ? '' : 'none';
            });
        });

        function paginate() {
            const rows = document.querySelectorAll('#newsTable tr');
            const rowsPerPage = 8;
            const pageCount = Math.ceil(rows.length / rowsPerPage);
            const pagination = document.querySelector('.pagination');
            pagination.innerHTML = '';

            for (let i = 1; i <= pageCount; i++) {
                const li = document.createElement('li');
                li.className = 'page-item';
                const a = document.createElement('a');
                a.className = 'page-link';
                a.href = '#';
                a.innerText = i;
                a.addEventListener('click', function (e) {
                    e.preventDefault();
                    showPage(this.innerText);
                });
                li.appendChild(a);
                pagination.appendChild(li);
            }

            showPage(1);
        }

        function showPage(pageNumber) {
            const rows = document.querySelectorAll('#newsTable tr');
            const rowsPerPage = 8;
            const start = (pageNumber - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            rows.forEach((row, index) => {
                row.style.display = (index >= start && index < end) ? '' : 'none';
            });

            const pageLinks = document.querySelectorAll('.page-item');
            pageLinks.forEach(link => link.classList.remove('active'));
            pageLinks[pageNumber - 1].classList.add('active');
        }

        function toggleTheme() {
            const body = document.body;
            const currentTheme = body.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            body.setAttribute('data-theme', newTheme);
        }

        paginate();
    </script>
</body>
</html>
