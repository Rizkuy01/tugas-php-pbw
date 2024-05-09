<?php

class Book {
    private $code_book;
    private $name;
    private $qty;

    public function __construct($code_book, $name, $qty) {
        $this->setCodeBook($code_book);
        $this->setName($name);
        $this->setQty($qty);
    }

    private function setCodeBook($code_book) {
        if (preg_match('/^[A-Z]{2}\d{2}$/', $code_book)) {
            $this->code_book = $code_book;
        } else {
            throw new InvalidArgumentException("Invalid code book format: $code_book");
        }
    }

    private function setName($name) {
        $this->name = $name;
    }

    private function setQty($qty) {
        if (is_int($qty) && $qty > 0) {
            $this->qty = $qty;
        } else {
            throw new InvalidArgumentException("Quantity must be a positive integer: $qty");
        }
    }

    public function getCodeBook() {
        return $this->code_book;
    }

    public function getName() {
        return $this->name;
    }

    public function getQty() {
        return $this->qty;
    }
}

