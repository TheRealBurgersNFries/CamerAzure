package com.camerazure.camerazure;

import android.content.Context;
import android.graphics.Canvas;
import android.graphics.SurfaceTexture;
import android.opengl.GLES20;
import android.util.AttributeSet;
import android.view.Surface;
import android.view.ViewGroup;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;

/**
 * Created by Shayne on 11/22/2015.
 */



public class CustomWebView extends WebView {
    private final int TEXTURE_WIDTH = ( 720 );
    private final int TEXTURE_HEIGHT = ( 720 );

    private Surface surface = null;



    public CustomWebView( Context context) {
        super( context );
        init();
    }

    public CustomWebView(Context context, AttributeSet attributeSet) {
        super(context, attributeSet);
        init();
    }

    public CustomWebView(Context context, AttributeSet attributeSet, int style) {
        super(context, attributeSet, style);
        init();
    }

    private void init() {
        //setWebChromeClient(new WebChromeClient() {});
        //setWebViewClient(new WebViewClient());
        //GLES20.te
        //surface = new Surface(new SurfaceTexture(1))
        //setLayoutParams(new ViewGroup.LayoutParams(TEXTURE_WIDTH, TEXTURE_HEIGHT));
    }



    @Override
    protected void onDraw( Canvas canvas) {
        /*if ( surface != null ) {
            try {
                final Canvas surfaceCanvas = surface.lockCanvas(null);*/
                super.onDraw(canvas);
                //surface = new Surface(new Surfa)
                /*surface.unlockCanvasAndPost(surfaceCanvas);
            } catch ( Surface.OutOfResourcesException excp ) {
                excp.printStackTrace();
            }
        }*/

    }

}
