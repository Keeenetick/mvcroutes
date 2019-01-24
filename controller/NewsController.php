<?php
include_once ROOT.'/models/News.php';

/**
 * summary
 */
class NewsController{

  
    public function actionIndex() {
    	$newsList = array();
    	$newsList = News::getNewsList();
        require_once(ROOT.'/view/news/index.php');
        return true;
    }

    public function actionView($id) {
    	if($id){
            $newsItem = News::getNewsByID($id);
            echo '<pre>';
            print_r($newsItem);
            echo '</pre>';
        }
		return true;
    	
    }
}