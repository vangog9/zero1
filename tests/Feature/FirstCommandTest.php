<?php


test('1st command', function () {
    $this->artisan('FirstCommand')
        ->expectsOutput('Hello World')
        ->assertExitCode(0);
});
