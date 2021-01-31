<?php

namespace Tests\Unit;

use Tests\TestCase;

class SendEmailCommandTest extends TestCase
{
    /**
     * Test send mail command.
     *
     * @return void
     */
    public function testSendEmailCommand()
    {
        $this->artisan('emails:send')
            ->expectsQuestion('Email recipients', 'example@example.com')
            ->expectsQuestion('Email subject', 'example subject')
            ->expectsQuestion('Email message', 'example message')
            ->assertExitCode(0);
    }

    /**
     * Test failed send mail command.
     *
     * @return void
     */
    public function testFailedSendEmailCommand()
    {
        $this->artisan('emails:send')
            ->expectsQuestion('Email recipients', 'invalid recipients')
            ->expectsQuestion('Email subject', 'example subject')
            ->expectsQuestion('Email message', 'example message')
            ->expectsOutput('Email request is invalid');
    }

}
