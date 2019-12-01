<?php
namespace OliverHader\BookStoreApp\Domain\Dto;

use OliverHader\BookStoreApp\Domain\Model\Author;
use OliverHader\BookStoreApp\Domain\Model\Book;

class AuthorPublication
{
    /**
     * @var Author
     */
    protected $author;

    /**
     * @var Book
     */
    protected $book;

    public function __construct(Author $author, Book $book)
    {
        $this->author = $author;
        $this->book = $book;
    }

    /**
     * @return Author
     */
    public function getAuthor(): Author
    {
        return $this->author;
    }

    /**
     * @return Book
     */
    public function getBook(): Book
    {
        return $this->book;
    }

    public function getName(): string
    {
        return $this->author->getName();
    }

    public function getPublicationDate(): \DateTime
    {
        return $this->book->getPublicationDate();
    }
}