<?php

class AboutController extends Controller {

    public function actionPrivacy() {
        $page = Page::model()->findByPk(2);
        $this->render('pages', array('page' => $page));
    }

    public function actionTerms() {
        $page = Page::model()->findByPk(3);
        $this->render('pages', array('page' => $page));
    }

}
