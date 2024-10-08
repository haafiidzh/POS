 <section class="card">
     <h2 class="text-2xl mb-3 mt-10">Lessons</h2>

     <div class="bg-white w-full" x-data="{ selected: 1 }">
         <ul class="flex flex-col gap-4">
             @foreach ($course->steps as $step)
                 <x-front::step.list :course="$course" :progress="$progress" :step="$step" :loop="$loop" />
             @endforeach
         </ul>
     </div>
 </section>
