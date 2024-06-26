# Integrate ChatGPT API with Laravel 11

In this article, I would like to share with you how to integrate Chat GPT API in laravel 11 application.

**What is ChatGPT/OpenAI?**

ChatGPT is a smart computer program made by OpenAI. It can understand and write text like a human. You can chat with it, ask questions, or get help with writing. It's like having a conversation with a very knowledgeable robot. People use it for fun, learning, and even work. OpenAI is the company that created ChatGPT and other advanced technology to help make computers more useful and helpful for everyone.

In this example, we will use the openai-php/laravel Composer package to access the OpenAI API. We will create a simple form where the user can enter their title or idea. Then, we will call the ChatGPT API to get a list of domain names based on that idea. Essentially, we will make a simple page where the user enters a title, and ChatGPT helps suggest domain names for it.

Let's now proceed to the step-by-step example of integrating OpenAI API in Laravel 11.

Step for Laravel 11 Integrate ChatGPT / OpenAI API Example
----------------------------------------------------------

*   **Step 1:** Install Laravel
*   **Step 2:** Install openai-php/laravel Package
*   **Step 3:** Create OpenAI Account
*   **Step 4:** Create Route
*   **Step 5:** Create Controller
*   **Step 6:** Create Blade File
*   **Run Laravel App**

**Step 1: Install Laravel**

To begin, we must obtain the latest version of the Laravel application by executing the command stated below. Open your terminal or command prompt and enter the given command.

```
composer create-project laravel/laravel integrate-laravel11-chatGPT
```


**Step 2: Install openai-php/laravel Package**

In this step, we need to install openai-php/laravel composer package to use OpenAI API. so let's run bellow command:

```
composer require openai-php/laravel
```


Now, we will publish configuration file using the following command:

```
php artisan vendor:publish --provider="OpenAI\Laravel\ServiceProvider"
```


**Step 3: Create OpenAI Account**

First you need to create Account on OpenAI website.

1\. Go to [https://platform.openai.com/](https://platform.openai.com/) you can register there you will get free access $18 credit for next three months.

2\. After that go to [https://platform.openai.com/account/api-keys](https://platform.openai.com/account/api-keys) and generate the API token.

You need to copy API key and add on your .env file as like the below:

Then add your API KEY to .env file:

.env

```
OPENAI_API_KEY=api_key...

```


**Step 4: Create Route**

now we will create one route for calling our example, so let's add new route to web.php file as bellow:

routes/web.php

```
<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\ChatGPTController;
  
Route::get('/chat-gpt', [ChatGPTController::class, 'index'])->name('chat-gpt.index');

```


**Step 5: Create Controller**

in this step, we will create ChatGPTController and write payment logic, so let's add new route to web.php file as bellow:

app/Http/Controllers/ChatGPTController.php

```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use OpenAI\Laravel\Facades\OpenAI;

class ChatGPTController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        $result = '';

        if ($request->filled('title')) {
            $messages = [
                ['role' => 'user', 'content' => 'suggest me 5 domain names from "'.$request->title.'" topic. simply give me domain names list with 1. 2. 3. 4. 5. '],
            ];

            $result = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => $messages,
            ]);

            $result = Arr::get($result, 'choices.0.message')['content'] ?? '';
        }

        return view('chatGPT', compact('result'));

    }
}

```


**Step 6: Create Blade File**

here, we need to create chatGPT.blade.php file and update following code on it.

resources/views/chatGPT.blade.php

```
<!DOCTYPE html>
<html>
<head>
    <title>Laravel 11 Integrate Chat GPT API Example - ItSolutionStuff.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
     
<body>
    <div class="container">
        <div class="card mt-5">
            <h3 class="card-header p-3">Laravel 11 Integrate Chat GPT API Example - ItSolutionStuff.com</h3>
            <div class="card-body"> 
                <form method="GET" action="{{ route('chat-gpt.index') }}">
                    <div class="form-group">
                        <label><strong>Give me your title, I will provide you domains list.</strong></label>
                        <input type="text" name="title" class="form-control" />
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>

                @if(!empty($result))
                    <div class="mt-5">
                        <strong>Result:</strong><br/>
                        {!! nl2br($result) !!}
                    </div>
                @endif

            </div>
        </div>
    </div>
</body>
</html>

```


**Run Laravel App:**

All the required steps have been done, now you have to type the given below command and hit enter to run the Laravel app:

```
php artisan serve
```


Now, Go to your web browser, type the given URL and view the app output:

```
http://localhost:8000/chat-gpt
```

Now, it's done...

I hope it can help you...

---
**Ref:** https://www.itsolutionstuff.com/post/how-to-integrate-chatgpt-api-with-laravel-11example.html