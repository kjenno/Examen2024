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
                        <a href="index.php">
                            <img class="color-dark9" loading="lazy" alt="Logo" src="./public/color--dark.svg" />
                        </a>

                        <nav class="column8">
                            <a href="diensten.php" class="link-text17">Diensten</a>
                            <a href="projecten.php" class="link-text18">Projecten</a>
                            <a href="planning.php" class="nav-link-dropdown4">Planning</a>
                        </nav>
                    </div>
                    <a href="login.php" class="stylesecondary-smalltrue-a4">
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
                    include("DatabaseConnection.php");


                    $Sql = "SELECT * FROM events ORDER BY event_date, event_time";
                    $Result = $Conn->query($Sql);

                    if ($Result->num_rows > 0) {
                        $CurrentDate = null;

                        
                        while($Row = $Result->fetch_assoc()) {
                            $EventDate = date('l d M', strtotime($Row['event_date']));

                            
                            if ($EventDate != $CurrentDate) {
                                if ($CurrentDate !== null) {
                                    echo '</div></div>'; 
                                }
                                echo '<div class="dropdown2">';
                                echo '<div class="dropdown3"><h1 class="heading20">' . $EventDate . '</h1></div>';
                                echo '<div class="events1">';
                                $CurrentDate = $EventDate;
                            }

                            
                            echo '<div class="card1">';
                            echo '<div class="iconactionvisibilitypx">' . date('H:i', strtotime($Row['event_time'])) . ' uur</div>';
                            echo '<div class="event-details1">';
                            echo '<h3 class="heading21">' . htmlspecialchars($Row['event_name']) . '</h3>';
                            echo '<div class="tags">';
                            if ($Row['event_type'] == 'Fysiek' || $Row['event_type'] == 'Online') {
                                echo '<div class="text13">' . htmlspecialchars($Row['event_type']) . '</div>';
                            }
                            echo '</div>';
                            echo '<div class="second-event-details">' . htmlspecialchars($Row['location']) . '</div>';
                            echo '</div></div>';
                        }
                        echo '</div></div>'; 
                    } else {
                        echo '<p>Geen evenementen gepland.</p>';
                    }

                    $Conn->close();
                    ?>
                </div>
            </section>
        </main>

        <footer class="footer-74">
            <div class="content44">
                <div class="logo4">
                    <img class="color-dark10" loading="lazy" alt="Logo" src="./public/color--dark.svg" />
                </div>
            </div>
        </footer>
    </div>
    
</body>
</html>


