package com.example.td_persistance_donnees_bdd;

import android.content.Context;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.Volley;

public class RequestsHandler {
    private static RequestsHandler instance;
    private RequestQueue requestQueue;
    private static Context ctx;

    private RequestsHandler(Context context) {
        ctx = context;
        requestQueue = getRequestQueue();

    }

    public static synchronized RequestsHandler getInstance(Context context) {
        if (instance == null) {
            instance = new RequestsHandler(context);
        }
        return instance;
    }

    public RequestQueue getRequestQueue() {
        if (requestQueue == null) {
            requestQueue = Volley.newRequestQueue(ctx.getApplicationContext());
        }
        return requestQueue;
    }

    public <T> void addToRequestQueue(Request<T> req) {
        getRequestQueue().add(req);
    }


}