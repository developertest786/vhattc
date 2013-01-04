<?php
class DashBoardController extends BackendController {
    public function executeDefault() {
        $this->document()->title = 'DashBoard';
    }
}