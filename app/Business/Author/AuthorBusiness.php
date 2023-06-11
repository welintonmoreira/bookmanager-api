<?php


namespace App\Business\Author;


use App\Business\Business;
use App\Models\Author;

class AuthorBusiness extends Business
{
    /**
     * @param Author $author
     * @param array $data
     * @return Author
     */
    private static function save(Author $author, array $data): Author
    {
        $author->fill($data);
        $author->save();

        return $author;
    }

    /**
     * @param array $data
     * @return Author
     */
    public static function create(array $data): Author
    {
        return self::save((new Author()), $data);
    }

    /**
     * @param Author $author
     * @param array $data
     * @return Author
     */
    public static function update(Author $author, array $data): Author
    {
        return self::save($author, $data);
    }

    /**
     * @param Author $author
     * @return bool|null
     */
    public static function softDelete(Author $author): ?bool
    {
        return $author->delete();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public static function list(array $data): mixed
    {
        $query = Author::query();

        if (!empty($data['name'])) {
            $query->where('name', 'like', "%{$data['name']}%");
        }

        return $query->get(['id', 'name']);
    }
}
