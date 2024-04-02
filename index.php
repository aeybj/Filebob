

<?php
// Include the database connection file
require_once('connection.php');

// Fetch posts from the database
$sql = "SELECT posts.*, users.username FROM posts INNER JOIN users ON posts.author_id = users.id ORDER BY posts.created_at DESC";
$result = $conn->query($sql);

// Include header
include 'header.php';
?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="uploads/s1.jpeg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="uploads/s2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="uploads/s3.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container mt-4">
    <h2>Latest Posts</h2>
    <div class="row">
        <?php
        // Check if there are posts available
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<img src="uploads/' . $row["image"] . '" class="card-img-top" alt="' . $row["title"] . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["title"] . '</h5>';
                echo '<p class="card-text">' . substr($row["content"], 0, 100) . '...</p>';
                echo '<a href="article.php?id=' . $row["id"] . '" class="btn btn-primary">Read More</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            // No posts found
            echo '<div class="col">';
            echo '<p>No posts found.</p>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<?php
// Include footer
include 'footer.php';

// Close database connection
$conn->close();
?>