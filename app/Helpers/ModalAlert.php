<?php

namespace App\Helpers;

class ModalAlert
{
    /**
     * Set flash data untuk modal success
     * 
     * @param string $title
     * @param string $message
     * @param string $primaryButton
     * @param string|null $primaryAction
     * @return void
     */
    public static function success($title, $message, $primaryButton = 'OK', $primaryAction = null)
    {
        session()->flash('modal_alert', [
            'type' => 'success',
            'title' => $title,
            'message' => $message,
            'primaryButton' => $primaryButton,
            'primaryAction' => $primaryAction
        ]);
    }

    /**
     * Set flash data untuk modal error
     * 
     * @param string $title
     * @param string $message
     * @param string $primaryButton
     * @param string|null $primaryAction
     * @return void
     */
    public static function error($title, $message, $primaryButton = 'OK', $primaryAction = null)
    {
        session()->flash('modal_alert', [
            'type' => 'error',
            'title' => $title,
            'message' => $message,
            'primaryButton' => $primaryButton,
            'primaryAction' => $primaryAction
        ]);
    }

    /**
     * Set flash data untuk modal warning
     * 
     * @param string $title
     * @param string $message
     * @param string $primaryButton
     * @param string|null $primaryAction
     * @return void
     */
    public static function warning($title, $message, $primaryButton = 'OK', $primaryAction = null)
    {
        session()->flash('modal_alert', [
            'type' => 'warning',
            'title' => $title,
            'message' => $message,
            'primaryButton' => $primaryButton,
            'primaryAction' => $primaryAction
        ]);
    }

    /**
     * Set flash data untuk modal info
     * 
     * @param string $title
     * @param string $message
     * @param string $primaryButton
     * @param string|null $primaryAction
     * @return void
     */
    public static function info($title, $message, $primaryButton = 'OK', $primaryAction = null)
    {
        session()->flash('modal_alert', [
            'type' => 'info',
            'title' => $title,
            'message' => $message,
            'primaryButton' => $primaryButton,
            'primaryAction' => $primaryAction
        ]);
    }

    /**
     * Set flash data untuk modal konfirmasi
     * 
     * @param string $title
     * @param string $message
     * @param string $primaryButton
     * @param string $secondaryButton
     * @param string|null $primaryAction
     * @param string|null $secondaryAction
     * @return void
     */
    public static function confirm($title, $message, $primaryButton = 'Ya', $secondaryButton = 'Batal', $primaryAction = null, $secondaryAction = null)
    {
        session()->flash('modal_alert', [
            'type' => 'warning',
            'title' => $title,
            'message' => $message,
            'primaryButton' => $primaryButton,
            'secondaryButton' => $secondaryButton,
            'primaryAction' => $primaryAction,
            'secondaryAction' => $secondaryAction
        ]);
    }
}
