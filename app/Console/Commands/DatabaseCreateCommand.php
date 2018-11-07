<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;


class DatabaseCreateCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command create new db.';

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
     * @return mixed
     */
    public function handle()
    {

        $db_host = $this->ask('What is the hostname of your database?');
        $this->info("updating .env file with db_host=$db_host");
        $this->putPermanentEnv('DB_HOST',$db_host);
        $db_name = $this->ask('What is the new database name?');
        $this->info("updating .env file with db_name=$db_name");
        $this->putPermanentEnv('DB_DATABASE',$db_name);
        $db_username = $this->ask('What is your database username?');
        $this->info("updating .env file with db_username=$db_username");
        $this->putPermanentEnv('DB_USERNAME',$db_username);
        $db_password = $this->ask('What is your database password?');
        $this->info("updating .env file with db_password=$db_password");
        $this->putPermanentEnv('DB_PASSWORD',$db_password);


        $charset = config("database.connections.mysql.charset",'utf8mb4');
        $collation = config("database.connections.mysql.collation",'utf8mb4_unicode_ci');

        config(["database.connections.mysql.database" => null]);

        $query = "CREATE DATABASE IF NOT EXISTS $db_name CHARACTER SET $charset COLLATE $collation;";

        DB::statement($query);
        config(["database.connections.mysql.database" => $db_name]);
        try {

            DB::connection()->setDatabaseName($db_name);
            DB::connection()->reconnect();
            Artisan::call('migrate');
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
        //


    }


    public function putPermanentEnv($key, $value)
    {
        $path = realpath("DatabaseCreateCommand.php");
        $path=str_replace("app\Console\Commands","",$path);
        $path=$path.".env";
        $escaped = preg_quote('='.env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));
    }


}
