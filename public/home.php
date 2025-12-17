<?php

require_once __DIR__ . '/../src/Model/Job.php';
use Src\Model\Job;

$jobModel = new Job();

$location = $_GET['location'] ?? ''; 
$skill    = $_GET['skill'] ?? ''; 
$type     = $_GET['type'] ?? ''; 

$jobs = $jobModel->getAll($location, $skill, $type);


$allJobsForFilters = $jobModel->getAll(); 
$locations = array_unique(array_map('ucfirst', array_map('strtolower', array_column($allJobsForFilters, 'location'))));
$types     = array_unique(array_map('ucfirst', array_map('strtolower', array_column($allJobsForFilters, 'job_type'))));
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Job Finder Platform</title>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: #f4f4f4;
}

.head {
    background-color: #4CAF50;
    color: white;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.head h1 {
    margin: 0;
}

nav ul {
    margin: 0;
    padding: 0;
    list-style: none;
    display: flex;        
    gap: 25px;
}

nav ul li a {
    text-decoration: none;
    color: white;
    padding: 8px 15px;
    border-radius: 4px;
    transition: 0.3s;
    font-weight: bold;
}

nav ul li a:hover {
    background: #388E3C;
}

.label {
    margin-left: 20px;
}

.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 0 20px;
    animation: container 0.6s ease forwards;
}

@keyframes container {
    from { opacity: 0; }
    to { opacity: 1; }
}

.search-bar input[type="text"] {  
    width: 70%;
    padding: 10px;
    font-size: 16px;
}

.search-bar button {
    padding: 10px 15px;
    font-size: 16px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 3px;
    transition: 0.3s;
}

.search-bar button:hover {
    background-color: #3a8a3d;
    transform: scale(1.05);
}

.filter {
    margin: 15px 0 25px;
}

.filter label {
    margin-right: 10px;
    font-weight: bold;
}

.job-card {
    background: white;
    padding: 20px;
    margin-bottom: 15px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
    transition: 0.25s ease;
}

.job-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgb(66, 66, 66);
}

.job-card h3 {
    margin: 0;
    color: #333;
}

.job-card p {
    margin: 5px 0;
    color: #666;
}

.job-card button {
    margin-top: 10px;
    padding: 8px 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 3px;
    transition: 0.3s;
}

.job-card button:hover {
    background-color: #3a8a3d;
    transform: scale(1.05);
}

footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 15px;
    margin-top: 30px;
}
</style>

</head>
<body>

<div class="head">
    <h1>Job Finder</h1>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="content.php">Content</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
</div>

<div class="container">

<div class="search-bar">
    <form action="" method="GET" id="searchForm">
        <input type="text" name="skill" id="skill-search" value="<?= htmlspecialchars($skill) ?>" placeholder="Search skills / jobs ...">
        <button type="submit">Search</button>
        <a href="home.php"><button type="button">Clear Filter</button></a>
</div>

<div class="filter">
<label>Location:</label>
<select name="location" id="location" onchange="this.form.submit()">
    <option value="">All</option>
    <?php foreach($locations as $loc): ?>
        <option value="<?= $loc ?>" <?= strtolower($location)==strtolower($loc)?"selected":"" ?>><?= $loc ?></option>
    <?php endforeach; ?>
</select>

<label class="label">Job Type:</label>
<select name="type" id="type" onchange="this.form.submit()">
    <option value="">All</option>
    <?php foreach($types as $t): ?>
        <option value="<?= $t ?>" <?= strtolower($type)==strtolower($t)?"selected":"" ?>><?= $t ?></option>
    <?php endforeach; ?>
</select>
</form> </div>

<?php if(empty($jobs)) echo "<p style='color:red;'>No jobs found.</p>"; ?>

<?php foreach($jobs as $job): ?>
<div class="job-card" 
     data-location="<?= htmlspecialchars($job['location']) ?>" 
     data-type="<?= htmlspecialchars($job['job_type']) ?>" 
     onclick="window.location='job_details.php?id=<?= $job['id'] ?>'">

    <h3><?= $job['title'] ?></h3>
    <p>Location: <?= $job['location'] ?></p>
    <p>Skills: <?= $job['skills'] ?></p>
    <p>Type: <?= $job['job_type'] ?></p>
 
    <button onclick="window.location='job_details.php?id=<?= $job['id'] ?>'">
        View Details
    </button>
</div>
<?php endforeach; ?>

</div>

<footer>&copy; 2025 Job Finder. All rights reserved.</footer>

<script>
    const searchInput = document.querySelector('#skill-search'); 
    const jobCards = document.querySelectorAll('.job-card');


    searchInput.addEventListener('input', function() {
        const text = this.value.toLowerCase();

        jobCards.forEach(card => {
            const title = card.querySelector('h3').innerText.toLowerCase();
            const skills = card.querySelectorAll('p')[1].innerText.toLowerCase();
            
            if (title.includes(text) || skills.includes(text)) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    });
</script>
</body>
</html>