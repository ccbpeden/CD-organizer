<?php
    class Artist
{
    private $artistName;

    function __construct($artistName)
    {
        $this->artistName = $artistName;
    }

    function getName()
    {
        return $this->artistName;
    }

    function saveArtist()
    {
        array_push($_SESSION['list_of_artists'], $this);
    }
}
?>
