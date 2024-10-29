
<?php
include("DatabaseConnection.php");


$sql = "SELECT * FROM events ORDER BY event_date, event_time";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./planning.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" />
    <title>Planning</title>
</head>
<body>
    <div class="planning">
        <header class="inloggen1">
            <div class="navbar-63">
                <div class="content40">
                    <div class="content41">
                        <a href="index.html">
                            <img class="color-dark9" loading="lazy" alt="Logo" src="./public/color--dark.svg" />
                        </a>

                        <nav class="column8">
                            <a href="over-ons.html" class="link-text16">Over Ons</a>
                            <a href="diensten.html" class="link-text17">Diensten</a>
                            <a href="projecten.html" class="link-text18">Projecten</a>
                            <a href="#header54" class="nav-link-dropdown4">Planning</a>
                        </nav>
                    </div>

                    <a href="login.html" class="stylesecondary-smalltrue-a4">
                        <div class="button10">Inloggen</div>
                    </a>
                </div>
            </div>
        </header>

        <main class="header-54-parent">
            <section class="header-541" id="header54">
                <h1 class="short-heading-here3">Planning</h1>
                <div class="lorem-ipsum-dolor9">
                    Bekijk hier de planning van Hyperlight & Sound
                </div>
            </section>

            
            <section class="event-31">
                <div class="section-title5">
                    <div class="tagline-wrapper4">
                        <div class="tagline3">Planning</div>
                    </div>
                    <div class="content42">
                        <h1 class="schedule">Schema</h1>
                        <div class="top-spacer">
                            Bekijk onze maandplanning voor aankomende evenementen en mis niets van onze activiteiten.
                        </div>
                    </div>
                </div>

                <div class="content43">
                    <?php
                    if ($result->num_rows > 0) {
                        $current_date = null;

                        
                        while($row = $result->fetch_assoc()) {
                            $event_date = date('l d M', strtotime($row['event_date']));

                            
                            if ($event_date != $current_date) {
                                if ($current_date !== null) {
                                    echo '</div></div>'; 
                                }
                                echo '<div class="dropdown2">';
                                echo '<div class="dropdown3"><h1 class="heading20">' . $event_date . '</h1></div>';
                                echo '<div class="events1">';
                                $current_date = $event_date;
                            }

                            
                            echo '<div class="card1">';
                            echo '<div class="iconactionvisibilitypx">' . date('H:i', strtotime($row['event_time'])) . ' uur</div>';
                            echo '<div class="event-details1">';
                            echo '<h3 class="heading21">' . htmlspecialchars($row['event_name']) . '</h3>';
                            echo '<div class="tags">';
                            if ($row['event_type'] == 'Fysiek' || $row['event_type'] == 'Online') {
                                echo '<div class="text13">' . htmlspecialchars($row['event_type']) . '</div>';
                            }
                            echo '</div>';
                            echo '<div class="second-event-details">' . htmlspecialchars($row['location']) . '</div>';
                            echo '</div></div>';
                        }
                        echo '</div></div>'; 
                    } else {
                        echo '<p>Geen evenementen gepland.</p>';
                    }

                    $conn->close();
                    ?>
                </div>
            </section>
        </main>

        <footer class="footer-74">
            <div class="content44">
                <div class="logo4">
                    <img class="color-dark10" loading="lazy" alt="Logo" src="./public/color--dark.svg" />
                </div>
                <div class="links4">
                    <a href="over-ons.html" class="text13">Over ons</a>
                    <a href="diensten.html" class="text13">Diensten</a>
                    <a href="projecten.html" class="text13">Projecten</a>
                    <a href="contact.html" class="link-four4">Contact</a>
                    <a href="blog.html" class="text13">Blog</a>
                </div>
            </div>
        </footer>
    </div>jrfn
    
</body>
</html>


