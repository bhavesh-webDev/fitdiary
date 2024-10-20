


<?php
session_start();
?>
<header>
    <div class="logo">FITDAIRY</div>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="#exercise-videos">Exercise Videos</a></li>
            <li><a href="#track-fitness">Track Fitness</a></li>
            <li><a href="#diet-plans">Diet Plans</a></li>
            <li><a href="bmi.html">Calculate BMI</a></li>
            <li><a href="bmr.html">Calculate BMR</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.html">Login</a></li>
                <li><a href="signup.html">Signup</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

