<?php

namespace Modules\Front\Http\Controllers\Front;

use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Course\Models\Course;
use Modules\Course\Models\CourseStep;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function course()
    {
        return view('front::pages.course');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function showCourse(Request $request)
    {
        $course = Course::where('slug', $request->course)->firstOrFail();
        return view('front::pages.show-course', [
            'course' => $course,
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function showLesson(Request $request)
    {
        $course = Course::where('slug', $request->course)->firstOrFail();
        $lesson = CourseStep::where('slug', $request->lesson)->firstOrFail();

        // foreach ($course->lessons as $wow) {
        //     CustomerCourseProgress::firstOrCreate([
        //         'customer_id' => auth('customer')->id(),
        //         'course_id' => $course->id,
        //         'step_id' => $wow->parent_id,
        //         'lesson_id' => $wow->id,
        //         'current_second' => 500,
        //         'is_complete' => 1,
        //     ]);
        // }

        // return true;
        return view('front::pages.show-lesson', [
            'course' => $course,
            'lesson' => $lesson,
        ]);
    }

    /**
     * generateRawCertificate
     *
     * @param  mixed $request
     * @return void
     */
    public function generateCertificate(Request $request)
    {
        Debugbar::disable();
        $customer = auth('customer')->user();
        $customer_course = $request->customer_course;

        $logo = substr(cache('logo'), 0, 1) == '/' ? substr(cache('logo'), 1) : cache('logo');
        $font_path = config('dompdf.options.font_dir');
        $data = [
            'fonts' => [
                'BonheurRoyale' => $font_path . '/BonheurRoyale-Regular.ttf',
                'PlayfairDisplay' => $font_path . '/PlayfairDisplay-Regular.ttf',
                'PlusJakartaSans' => $font_path . '/PlusJakartaSans-Regular.ttf',
                'PlusJakartaSans-Bold' => $font_path . '/PlusJakartaSans-Bold.ttf',
            ],
            'background' => 'data:image/jpg;base64,' . base64_encode(file_get_contents('assets/default/images/pattern_background.jpg')),
            'logo' => 'data:image/jpg;base64,' . base64_encode(file_get_contents($logo)),
            'signature' => [
                'name' => 'Achmad Ridho',
                'title' => 'Chief Executive Officer at ' . cache('app_name'),
                'sign' => 'data:image/png;base64,' . base64_encode(file_get_contents('assets/default/images/signature.png')),
            ],
            'customer' => $customer,
            'customer_course' => $customer_course,
            'verify_link' => route('front.accomplishment.verify', $customer_course->certificate_id),
            'filename' => $customer->name . ' - ' . $customer_course->certificate_id . '.pdf',
        ];

        $html = view('front::pdf.certificate-a4', $data)->render();
        $pdf = Pdf::loadHTML($html)
            ->setOption('dpi', 72)
            ->setPaper('a4', 'landscape')
            ->setWarnings(false);

        if ($request->mode == 'download') {
            return $pdf->download($customer->name . ' - ' . $customer_course->certificate_id . '.pdf');
        }

        return $pdf->stream($customer->name . ' - ' . $customer_course->certificate_id . '.pdf');
    }

    /**
     * verifyCertificate
     *
     * @param  Request $request
     * @return void
     */
    public function verifyCertificate(Request $request)
    {
        return view('front::pages.verify-certificate');
    }
}
