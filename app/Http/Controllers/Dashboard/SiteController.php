<?php
/**
 * Created by PhpStorm.
 * User: Furqan
 * Date: 8/31/2017
 * Time: 12:28 AM
 */

namespace CachetHQ\Cachet\Http\Controllers\Dashboard;


use CachetHQ\Cachet\Models\Sites;
use CachetHQ\Cachet\Requests\SitesRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

class SiteController extends Controller
{
    public function addsite()
    {
        return view('dashboard.sites.add')
            ->withPageTitle('Add Multi Sites');
    }

    public function savesite(SitesRequest $request)
    {
        $site = new Sites();
        $new_site = $site->addsites($request->all());
        if($new_site) {
            $this->setupEnv($new_site);
            $this->setupDatabase($new_site);
        }
        return Redirect::to('dashboard/sites')->withSuccess(sprintf('%s %s', 'Site added successfully!', ''));
    }

    public function listsite()
    {
        $site = new Sites();
        $sites = $site::all();

        return view('dashboard.sites.list', compact('sites'));
    }

    public function updateSite($id, $status) {
        Sites::where('id', $id)
            ->update(['status' => $status]);
        return Redirect::to('dashboard/sites')->withSuccess(sprintf('%s %s', 'Site updated successfully!', ''));
    }

    public function setupEnv($new_site)
    {
        $new_env_name = '.'.str_replace('.','_',$new_site->url).'.env';
        $new_db_name = str_replace('.','_',$new_site->url);
        $_ENV['DB_DATABASE'] = $new_db_name;
        $envContent = '';
        if($_ENV){
            foreach($_ENV as $key => $val){
                $envContent .= "$key = $val\n";
            }
        }
        $myfile = fopen(base_path().'/'.$new_env_name, "w") or die("Unable to open file!");
        fwrite($myfile, $envContent);
        fclose($myfile);
    }

    public function setupDatabase($new_site)
    {

        $new_db = str_replace('.','_',$new_site->url);
        // Name of the file
        $filename = 'D:\cachet.sql';
        // MySQL host
        $mysql_host = 'localhost';
        // MySQL username
        $mysql_username = 'root';
        // MySQL password
        $mysql_password = '';
        // Database name
        $mysql_database = 'test';

        // Connect to MySQL server

        $conn = mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . die('error in connection!'));
        // Select database

        //mysqli_select_db($conn, $mysql_database) or die('Error selecting MySQL database: ' . mysqli_error($conn));

        ///////////////////////////////////////////////
        // Create database
        $sql = "CREATE DATABASE $new_db";
        if (mysqli_query($conn, $sql) === TRUE) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $conn->error;
        }
        mysqli_select_db($conn, $new_db) or die('Error selecting MySQL database: ' . mysqli_error($conn));
        //////////////////////////////////////////////////

        // Temporary variable, used to store current query
        $templine = '';
        // Read in entire file
        $lines = file($filename);
        // Loop through each line
        foreach ($lines as $line)
        {
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;

            // Add this line to the current segment
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';')
            {
                // Perform the query

                mysqli_query($conn, $templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($conn) . '<br /><br />');
                // Reset temp variable to empty
                $templine = '';
            }
        }
        echo "Tables imported successfully";
    }
}