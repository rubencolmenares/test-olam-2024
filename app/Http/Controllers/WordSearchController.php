<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordSearchController extends Controller
{
    //
    public function index()
    {
        return view('wordsearch.index');
    }

    public function search(Request $request)
    {
        // Obtener las palabras y la matriz de letras desde la solicitud
        $words = explode(',', $request->input('words'));
        $matrix = $this->parseMatrixInput($request->input('matrix'));

        // Realizar la búsqueda de palabras
        $result = $this->searchWords($words, $matrix);

        // Pasar los resultados a la vista result.blade.php
        return view('wordsearch.result', [
            'found' => $result['found'],
            'notFound' => $result['not_found'],
        ]);
    }

    // Función para convertir la entrada de matriz en un array bidimensional
    private function parseMatrixInput($matrixInput)
    {
        $rows = explode("\n", $matrixInput);
        $matrix = [];

        foreach ($rows as $row) {
            $matrix[] = str_split(trim($row));
        }

        return $matrix;
    }

    // Función para buscar las palabras en la matriz de letras
    private function searchWords($words, $matrix)
    {
        $foundWords = [];
        $notFoundWords = [];

        foreach ($words as $word) {
            $occurrences = $this->searchWordInMatrix($word, $matrix);

            // Agregar a la lista correspondiente
            if (!empty($occurrences)) {
                $foundWords[$word] = $occurrences;
            } else {
                $notFoundWords[] = $word;
            }
        }

        return ['found' => $foundWords, 'not_found' => $notFoundWords];
    }

    // Función para buscar una palabra en la matriz (horizontal, vertical, diagonal)
    private function searchWordInMatrix($word, $matrix)
    {
        $wordLength = strlen($word);
        $rows = count($matrix);
        $cols = count($matrix[0]);
        $occurrences = [];

        // Búsqueda horizontal
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j <= $cols - $wordLength; $j++) {
                $substring = implode('', array_slice($matrix[$i], $j, $wordLength));
                if ($substring === $word) {
                    $occurrences[] = ['startRow' => $i, 'startCol' => $j];
                }
            }
        }

        // Búsqueda vertical
        for ($i = 0; $i <= $rows - $wordLength; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                $substring = '';
                for ($k = 0; $k < $wordLength; $k++) {
                    $substring .= $matrix[$i + $k][$j];
                }
                if ($substring === $word) {
                    $occurrences[] = ['startRow' => $i, 'startCol' => $j];
                }
            }
        }

        // Búsqueda diagonal
        for ($i = 0; $i <= $rows - $wordLength; $i++) {
            for ($j = 0; $j <= $cols - $wordLength; $j++) {
                $substring = '';
                for ($k = 0; $k < $wordLength; $k++) {
                    $substring .= $matrix[$i + $k][$j + $k];
                }
                if ($substring === $word) {
                    $occurrences[] = ['startRow' => $i, 'startCol' => $j];
                }
            }
        }

        return $occurrences;
    }

}
