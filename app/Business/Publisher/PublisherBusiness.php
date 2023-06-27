<?php


namespace App\Business\Publisher;


use App\Business\Business;
use App\Models\Publisher;

class PublisherBusiness extends Business
{
    /**
     * @param Publisher $publisher
     * @param array $data
     * @return Publisher
     */
    private static function save(Publisher $publisher, array $data): Publisher
    {
        $publisher->fill($data);
        $publisher->save();

        return $publisher;
    }

    /**
     * @param array $data
     * @return Publisher
     */
    public static function create(array $data): Publisher
    {
        return self::save((new Publisher()), $data);
    }

    /**
     * @param Publisher $publisher
     * @param array $data
     * @return Publisher
     */
    public static function update(Publisher $publisher, array $data): Publisher
    {
        return self::save($publisher, $data);
    }

    /**
     * @param Publisher $publisher
     * @return bool|null
     */
    public static function softDelete(Publisher $publisher): ?bool
    {
        return $publisher->delete();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public static function list(array $data): mixed
    {
        $query = Publisher::query();

        if (!empty($data['name'])) {
            $query->where(function ($query) use ($data) {
                $query->where('name', 'like', "%{$data['name']}%")
                    ->orWhere('full_name', 'like', "%{$data['name']}%");
            });
        }

        return $query->get(['id', 'name', 'full_name']);
    }
}
