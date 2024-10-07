<?php

class RequestHandler {
    public static function getPost($key = null) {
        if ($key === null) {
            return $_POST;
        }
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    public static function getGet($key = null) {
        if ($key === null) {
            return $_GET;
        }
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    public static function getServer($key = null) {
        if ($key === null) {
            return $_SERVER;
        }
        return isset($_SERVER[$key]) ? $_SERVER[$key] : null;
    }
}
