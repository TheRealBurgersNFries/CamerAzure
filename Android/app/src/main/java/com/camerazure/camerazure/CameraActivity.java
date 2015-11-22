package com.camerazure.camerazure;

import android.app.AlertDialog;
import android.app.Dialog;
import android.app.DialogFragment;
import android.app.FragmentManager;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.graphics.Canvas;
import android.graphics.Picture;
import android.media.audiofx.BassBoost;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.preference.PreferenceManager;
import android.provider.MediaStore;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Gravity;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.webkit.WebView;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.PopupWindow;
import android.widget.Toast;
import android.widget.VideoView;

import java.io.File;
import java.io.FileOutputStream;
import java.text.SimpleDateFormat;
import java.util.Date;

public class CameraActivity extends AppCompatActivity {

    ImageView myCamera;
    CustomWebView webView;
    private static final int CAPTURE_IMAGE_ACTIVITY_REQUEST_CODE = 100;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_camera);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
        boolean localCameraPref = sharedPref.getBoolean(SettingsActivity.KEY_CAMERA, true);
        if (!localCameraPref)
        {
            webView = (CustomWebView) findViewById(R.id.webview2);
            webView.loadUrl("https://stream-delta.dropcam.com/nexus_aac/b8fbe1918dd5470e913d5780445bc66b/playlist.m3u8");
        }
        else if (localCameraPref)
        {
            webView = (CustomWebView) findViewById(R.id.webview2);
            webView.loadUrl("https://stream-delta.dropcam.com/nexus_aac/b8fbe1918dd5470e913d5780445bc66b/playlist.m3u8");
        Intent picIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        //Uri fileUri = getOutputMediaFileUri(MEDIA_TYPE_IMAGE);
        //picIntent.putExtra(MediaStore.EXTRA_OUTPUT, fileUri);
        startActivityForResult(picIntent, CAPTURE_IMAGE_ACTIVITY_REQUEST_CODE);

    }
    }

    public static final int MEDIA_TYPE_IMAGE = 1;
    public static final int MEDIA_TYPE_VIDEO = 2;

    /** Create a file Uri for saving an image or video */
    private static Uri getOutputMediaFileUri(int type){
        return Uri.fromFile(getOutputMediaFile(type));
    }

    /** Create a File for saving an image or video */
    private static File getOutputMediaFile(int type){
        // To be safe, you should check that the SDCard is mounted
        // using Environment.getExternalStorageState() before doing this.

        File mediaStorageDir = new File(Environment.getExternalStoragePublicDirectory(
                Environment.DIRECTORY_PICTURES), "MyCameraApp");
        // This location works best if you want the created images to be shared
        // between applications and persist after your app has been uninstalled.

        // Create the storage directory if it does not exist
        if (! mediaStorageDir.exists()){
            if (! mediaStorageDir.mkdirs()){
                Log.d("MyCameraApp", "failed to create directory");
                return null;
            }
        }

        // Create a media file name
        String timeStamp = new SimpleDateFormat("yyyyMMdd_HHmmss").format(new Date());
        File mediaFile;
        if (type == MEDIA_TYPE_IMAGE){
            mediaFile = new File(mediaStorageDir.getPath() + File.separator +
                    "IMG_"+ timeStamp + ".jpg");
        } else if(type == MEDIA_TYPE_VIDEO) {
            mediaFile = new File(mediaStorageDir.getPath() + File.separator +
                    "VID_"+ timeStamp + ".mp4");
        } else {
            return null;
        }

        return mediaFile;
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (resultCode == RESULT_OK) {
            // Image captured and saved to fileUri specified in the Intent
            Toast.makeText(this, "Image saved to:\n" +
                    data.getData(), Toast.LENGTH_LONG).show();


        } else if (resultCode == RESULT_CANCELED) {
            // User cancelled the image capture
        } else {
            // Image capture failed, advise user
        }
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_camera, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            settings();
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    public void recognize(View vew)
    {
        //TODO: Send image to server for Clousight image recognition
    }

    public void capture(View view) {
        View rootView = webView;
        rootView.setDrawingCacheEnabled(true);
        Bitmap screenshot = rootView.getDrawingCache();
        //Bitmap bitmap = Bitmap.createBitmap(myWebView.getWidth(),
        //        myWebView.getHeight(), Bitmap.Config.ARGB_8888);
        Canvas canvas = new Canvas(screenshot);
        webView.draw(canvas);


        Date now = new Date();
        android.text.format.DateFormat.format("yyyy-MM-dd_hh:mm:ss", now);

        try {
            // image naming and path  to include sd card  appending name you choose for file
            String mPath = Environment.getExternalStorageDirectory().toString() + "/" + now + ".jpg";



            File imageFile = new File(mPath);

            FileOutputStream outputStream = new FileOutputStream(imageFile);
            int quality = 100;
            screenshot.compress(Bitmap.CompressFormat.JPEG, quality, outputStream);
            outputStream.flush();
            outputStream.close();

        } catch (Throwable e) {
            // Several error may come out with file handling or OOM
            e.printStackTrace();
        }
    }

    public void print_ship(View view)
    {
        AlertDialog.Builder builder1 = new AlertDialog.Builder(this);
        builder1.setMessage("Where do you want it shipped?");
        final EditText input = new EditText(this);
        input.setHint("Where are you?");
        LinearLayout.LayoutParams lp = new LinearLayout.LayoutParams(
                LinearLayout.LayoutParams.MATCH_PARENT,
                LinearLayout.LayoutParams.MATCH_PARENT);
        input.setLayoutParams(lp);
        builder1.setView(input);
        builder1.setCancelable(true);
        builder1.setPositiveButton("OK",
                new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int id) {
                        //TODO: Implement API request to print/send/pay for picture
                        dialog.cancel();
                    }
                });
        builder1.setNegativeButton("Cancel",
                new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int id) {
                        dialog.cancel();
                    }
                });

        AlertDialog alert11 = builder1.create();
        alert11.show();


    }

    public void settings()
    {
        Intent settingsIntent = new Intent(this, SettingsActivity.class);
        startActivity(settingsIntent);
    }

}
