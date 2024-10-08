<?php

namespace Modules\Front\Console;

use Exception;
use Illuminate\Console\Command;
use Modules\Course\Models\Course;
use Modules\Course\Models\CourseStep;
use Modules\Course\Models\CustomerCourse;
use Symfony\Component\Console\Input\InputOption;
use Modules\Course\Models\CustomerCourseProgress;
use Modules\Customer\Models\Customer;
use Symfony\Component\Console\Input\InputArgument;

class CompleteCourseSimulation extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'course:mark-complete {email?} {slug_course?}';

    /**
     * The console command description.
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $email = $this->argument('email');
            $slug = $this->argument('slug_course');

            $course = Course::where('slug', $slug)->firstOrFail();
            $customer = Customer::where('email', $email)->firstOrFail();
            $find = CustomerCourse::where('customer_id', $customer->id)->where('course_id', $course->id)->firstOrFail();

            foreach ($course->lessons as $lesson) {
                $progress = CustomerCourseProgress::where([
                    'customer_id' => $customer->id,
                    'course_id' => $course->id,
                    'step_id' => $lesson->parent_id,
                    'lesson_id' => $lesson->id,
                ])->first();

                if (!$progress) {
                    CustomerCourseProgress::create([
                        'customer_id' => $customer->id,
                        'course_id' => $course->id,
                        'step_id' => $lesson->parent_id,
                        'lesson_id' => $lesson->id,
                        'current_second' => 500,
                        'is_complete' => 1,
                    ]);
                }
            }

            $find->update([
                'is_complete' => 1,
                'completed_at' => now(),
                'certificate_id' => CustomerCourse::generateId('string', 12, 32, 'certificate_id'),
                'certificate_expired_date' => $find->course->certificate_duration ? now()->addDays($find->course->certificate_duration) : null,
            ]);

            return $this->info('Message: Course has been marked as complete.');
        } catch (Exception $exception) {
            return $this->error('Message: ' . $exception->getMessage());
        }


        // return true;

    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
