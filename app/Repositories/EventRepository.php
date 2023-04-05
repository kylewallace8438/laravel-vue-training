<?php
namespace App\Repositories;

use App\Models\Event;

class EventRepository implements AbstractRepositoryInterface
{
    public function show()
    {
        return Event::all();
    }
    public function create(array $attributes)
    {
        return Event::create($attributes);
    }
    public function getById($id)
    {
        return Event::find($id);
    }
    public function update($id, array $attributes)
    {
        $event = Event::find($id);
        $event->update($attributes);
        return $event;
    }
    public function delete($id)
    {
        $event = Event::find($id);
        $event->delete();
    }
}
