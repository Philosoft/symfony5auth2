<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class LoginController
{
    public function showForm(): Response
    {
        $formMarkup = <<<END
<form action="/login" method="POST">
    <div>
        <label for="username">username</label>
        <input type="text" name="username" id="username">
    </div>
    
    <div>
        <label for="password">password</label>
        <input type="password" name="password" id="password">
    </div>
    
    <div>
        <button type="submit">login</button>
    </div>
</form>
END;


        return new Response($formMarkup);
    }
}
