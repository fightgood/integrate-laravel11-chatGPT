<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use OpenAI\Laravel\Facades\OpenAI;

/**
 *
 */
class ChatGPTController extends Controller
{
  /**
   * Write code on Method
   *
   * @param  Request  $request
   *
   * @return View ()
   */
  public function index(Request $request): View
  {
    $result = '';
    
    if ($request->filled('title')) {
      $messages = [
        [
          'role'    => 'user',
          'content' => 'suggest me 5 domain names from "'.$request->title.'" topic. simply give me domain names list with 1. 2. 3. 4. 5. ',
        ],
      ];
      
      $result = OpenAI::chat()->create([
                                         'model'    => 'gpt-3.5-turbo',
                                         'messages' => $messages,
                                       ]);
      
      $result = Arr::get($result, 'choices.0.message')['content'] ?? '';
    }
    
    return view('chatGPT', compact('result'));
  }
}
