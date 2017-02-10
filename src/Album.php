<?php
class Album
{
    private $album_name;
    private $artist_name;


    function __construct($artist_name, $album_name)
    {
        $this->artist_name = $artist_name;
        $this->album_name = $album_name;
    }

    function getAlbumName()
    {
        return $this->album_name;
    }

    function getArtist()
    {
        return $this->artist_name;
    }

    function SaveAlbum()
    {
        array_push($_SESSION['list_of_albums'], $this);
    }

    function compareArtist($input_artist)
    {
        $possessedArtist = strtolower($this->getArtist());
        $inputArtist = strtolower($input_artist);
        if (strpos($possessedArtist, $inputArtist) !== false){
          return true;
        };
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
