<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable {
	use Queueable, SerializesModels;

	public $data = [];
	public $view;
	public $subject;
	public $attachPath;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($data, $view, $subject, $attach = '') {
		$this->data = $data;
		$this->view = $view;
		$this->subject = $subject;
		$this->attachPath = $attach ? $attach : '';
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		if ($this->attachPath) {
			return $this->subject($this->subject)
				->view($this->view)
				->with($this->data)
				->attach($this->attachPath);
		} else {
			return $this->subject($this->subject)
				->view($this->view)
				->with($this->data);
		}
	}
}
