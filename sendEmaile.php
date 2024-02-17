<?php


namespace App\Console\Commands;


use App\Mail\EmailSend;
use Illuminate\Console\Command;
use App\User;
use App\Mail\ProfessionalEmail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class sendEmaile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications for contracts approaching end date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $approachingEndDate = Carbon::now()->addDays(7); // Define how many days before the end date to send the email
        $users = User::all();

        foreach ($users as $user) {
            $contracts = $user->contrats()
            ->where('fin', '>', Carbon::now())
            ->where('fin', '<', $approachingEndDate)->where('deleted',0)->get(); // Get the contracts where the end date is approaching for the user

            if ($contracts->count() > 0) {
                $data = [
                    'responsibleName' => $user->name,
                    'contracts' => $contracts,
                ];

                // Send email notification to the responsible person
                Mail::to($user->email)->send(new EmailSend($data));
            }
        }
    }
}
