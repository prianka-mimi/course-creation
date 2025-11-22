<?php

// namespace App\Helpers;

// use Throwable;
use App\Manager\ImageUploadManager;
use Illuminate\Support\Facades\Log;

function app_error_log(string $name, Throwable $throwable, string $type = 'info'): void
{
    Log::{$type}($name, ['message' => $throwable->getMessage(), 'error' => $throwable]);
}

function app_success_log(string $name, string $message, string $type = 'info'): void
{
    Log::{$type}($name, ['message' => $message]);
}

function success_alert($message): void
{
    session()->flash('message', $message);
    session()->flash('class', 'success');
}

function failed_alert($message): void
{
    session()->flash('message', $message);
    session()->flash('class', 'warning');
}

function get_image(string|null $path): string
{
    return ImageUploadManager::get_image($path);
}
