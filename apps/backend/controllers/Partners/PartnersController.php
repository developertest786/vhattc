<?php
class PartnersController extends BackendController {
    public function executeDefault() {
    }

    public function executeForm() {
        $partner_id = $this->request()->get('partner_id', 'INT');
    }
}
