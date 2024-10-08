<?php

namespace App\Jobs\Submissions;

use App\Events\Submissions\SubmissionCreated;
use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreSubmissionDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private array $data
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $submission = Submission::create($this->data);

        event(new SubmissionCreated($submission));
    }
}
