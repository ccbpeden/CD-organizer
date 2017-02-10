<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Album.php";
    require_once __DIR__."/../src/Artist.php";


    session_start();

    if (empty($_SESSION['list_of_albums'])) {
        $_SESSION['list_of_albums'] = array();
    }
    if (empty($_SESSION['list_of_artists'])) {
        $_SESSION['list_of_artists'] = array();
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('albums.html.twig', array('albums' => Album::getAll()));
    });

    $app->post("/albums", function() use ($app) {
        $new_artist = new Artist($_POST['artist_name']);
        $new_artist->saveArtist();
        $new_album = new Album($_POST['artist_name'], $_POST['album_name']);
        $new_album->saveAlbum();
        return $app['twig']->render('albums.html.twig', array('albums' => Album::getAll()));
    });

    $app->get("/search", function() use ($app) {
        return $app['twig']->render('search.html.twig');
    });

    $app->post("/search", function() use ($app) {
        $albums = Album::getAll();
        $artist_matching_search = array();
        foreach ($albums as $album) {
            if($album->compareArtist($_POST['user_input'])) {
                array_push($artist_matching_search, $album);
            }
        }
        return $app['twig']->render('search.html.twig', array('matching' => $artist_matching_search));
    });
    $app->post("/delete_albums", function() use ($app) {
        Album::deleteAll();
        return $app['twig']->render('albums.html.twig', array('albums' => Album::getAll()));
    });
    return $app;
?>
