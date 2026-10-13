<?php
class Product {
    private $category;
    private $id;
    private $code;
    private $name;
    private $price;

    // Constructor without parameters
    public function __construct() {
        $this->category = null;
        $this->id = 0;
        $this->code = '';
        $this->name = '';
        $this->price = 0;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($value) {
        $this->category = $value;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($value) {
        $this->id = $value;
    }

    public function getCode() {
        return $this->code;
    }

    public function setCode($value) {
        $this->code = $value;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($value) {
        $this->name = $value;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($value) {
        $this->price = $value;
    }

    public function getPriceFormatted() {
        return number_format($this->price, 2);
    }

    public function getDiscountPercent() {
        return 30;
    }

    public function getDiscountAmount() {
        $discount_amount =
            $this->price * $this->getDiscountPercent() / 100;

        return number_format(round($discount_amount, 2), 2);
    }

    public function getDiscountPrice() {
        $discount_price =
            $this->price
            - ($this->price * $this->getDiscountPercent() / 100);

        return number_format($discount_price, 2);
    }

    public function getImageFilename() {
        return $this->code . '.png';
    }

    public function getImagePath() {
        return '../images/' . $this->getImageFilename();
    }

    public function getImageAltText() {
        return 'Image: ' . $this->getImageFilename();
    }
}
?>
