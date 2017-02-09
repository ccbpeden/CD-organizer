<?php
class Album
{
    private $album_name;

    function __construct($album_name, $artist)
    {
        $this->album_name = $album_name;
        $this->artist = $artist;
    }

    function getAlbumName()
    {
        return $this->album_name;
    }

    function getArtist()
    {
        return $this->artist;
    }

    function SaveAlbum()
    {
        array_push($_SESSION['list_of_albums'], $this);
    }

    function compareArtist($input_artist)
    {
        return strtolower($this->getArtistName()) == strtolower($input_artist);
    }

    static function getAll()
    {
        return $_SESSION['list_of_albums'];
    }
    static function deleteAll()
    {
        $_SESSION['list_of_albums'] = array();
    }
}
?>
