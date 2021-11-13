<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    private $animals = ['Kelinci', 'Rusa', 'Beruang'];

    public function index()
    {
        echo "Menampilkan data animals";
        echo '<br>';
        foreach ($this->animals as $animal) {
            echo "- $animal";
            echo '<br>';
        }
    }

    public function store(Request $request)
    {
        array_push($this->animals, $request->nama);
        echo "Menambahkan hewan baru";
        echo '<br>';
        $this->index();
    }

    public function update(Request $request, $id)
    {
        array_splice($this->animals, $id, 1, $request->nama);
        echo "Mengupdate data hewan id $id";
        echo '<br>';
        $this->index();
    }

    public function destroy($id)
    {
        array_splice($this->animals, $id, 1);
        echo "Menghapus data hewan id $id";
        echo '<br>';
        $this->index();
    }
}
