/**
 * Copyright 2010 Pimmetje 
 * contact Pimmetje (at) gmail (dot) com
 *  
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Load the mumble viewer inside a div and make use it gets renderd
 * 
 * @param jsonurl a full url to a JSONP from your mumble server
 * @param div the div to load the viewer in
 */
function mum(jsonurl, div, options) {
  $.getJSON(jsonurl,
    function(data){
      mum_parse(data, div,mum_options(options, data));
    });
}

/**
 * Check the given options and make sure all options that need to be used are set
 * 
 * @param options the options object from the user
 */
function mum_options(options, data) {
  var op = { "tooltip" : "true",
             "imgpath" : "http://cdn.rko.nu/mumble/"};

  if(options != null) {
    if(options.tooltip != null) op.tooltip = options.tooltip;
    if(options.imgpath != null) op.imgpath = options.imgpath;
  } 
  return op;
}

/**
 * Will render the view and put it in a div
 *
 * @param data the json data object
 * @param div the div to store the output in
 * @param options for the viewer
 */
function mum_parse(data, div, options) {
  if(data != null) {
    var d = mum_root(data, options);
    $('#' + div + ' [tooltip]').qtip("hide");
    $('#' + div + ' [tooltip]').qtip("destroy");
    $('#' + div).empty();
    $('#' + div).append(d);
    activatehover(div);
  }
}

/**
 * Rebder the mumble settings for root
 * 
 * @param data the server data
 * @return the renderd data
 */
function mum_root(data, options) {
  var tip = "IP:"+"<br />Uptime:";
  var d = "<div class=\"mumstatus\">";
  var src = (data.x_connecturl != null) ? data.x_connecturl : '';
  d += "<a href=\""+src+"\" tooltip=\""+ tip +"\">"+mum_img('mumble.png', '', options)+" Root: </a><br />";
  if(data.root.channels != null) {
    d += mum_channels(data.root.channels, options);
  }
  if(data.root.users != null) {
    d += mum_users(data.root.users, options);
  }
  d += "</div>";
  return d;
}

/**
 * Render a image for use in the viewer
 * 
 * @param file the file name of the image
 * @param alt the alt of the image
 * @param options for the viewer
 * @return valid html of the image for viewer
 */
function mum_img(file, alt, options) {
  return "<img src='"+ options.imgpath + file +"' alt='" + alt + "' />";
}

/**
 * Render channels and subchannels
 *
 * @param data the json data for the channels to render
 * @param options for the viewer
 * @return valid representation of the channel and subchannels
 */
function mum_channels(data, options) {
  var d = "";
  $.each(data,function (i,da) {
    d += mum_channel(da, options);
  });
  return d;
}

/**
 * Render a channel
 * 
 * @param data the json data for the channel to render
 * @param options for the viewer
 * @return valid representation of the channel
 */
function mum_channel(data, options) {
  var d = "<div class=\"mumstatusItem\"><div class=\"mumstatusLabel\">" +mum_img('channel.png', '', options) + data.name + "</div>";
  if(data.channels != null) {
    d += mum_channels(data.channels, options);
  }
  if(data.users != null) {
    d += mum_users(data.users, options);
  }
  d += "</div>";
  return d;
}

/**
 * Render users
 *
 * @param data user data
 * @param options for the viewer
 * @reten all users renderd
 */
function mum_users(data, options) {
  var d = "";
  $.each(data,function (i,da) {
    d += mum_user(da, options);
  });
  return d;
}

/**
 * Render a user
 * 
 * @param data user data
 * @param options for the viewer
 * @reten the user renderd
 */
function mum_user(data, options) {
  var tip = "Idle:" + parseTime(data.idlesecs) + "<br />Online:" + parseTime(data.onlinesecs) + "<br />OS:" +data.os;
  var img = (data.idlesecs == 0) ? mum_img('talking_on.png', '', options) : mum_img('talking_off.png', '', options);
  var d = "<div class=\"mumstatusItem\"><div class=\"mumstatusLabel\"><a tooltip=\""+ tip +"\">" +img+ data.name + "</div>";
  d += "<div class=\"mumstatusFlags\">";
  d += mum_userflags(data, options);
  d += "</div></a>";
  if(data.channels != null) {
    d += mum_users(data.users, options);
  }
  d += "</div>";
  return d;
}

/**
 * Create the img html code for all flags of a user
 * 
 * @param data user data
 * @param options for the viewer
 * @reten HTML code for all the images for user flags
 */
function mum_userflags(data, options) {
  var img = "";
  img += (data.mute) ? mum_img('muted_server.png', '', options) : "" ;
  img += (data.deaf) ? mum_img('deafened_server.png', '', options) : "";
  img += (data.suppressed) ? mum_img('muted_local.png', '', options) : "";
  img += (data.selfMute) ? mum_img('muted_self.png', '', options) : "";
  img += (data.selfDeaf) ? mum_img('deafened_self.png', '', options) : "";
  img += (data.id != -1) ? mum_img('authenticated.png', '', options) : "";
  return img;
}

/**
 * Activate the tooltip for a given div
 * 
 * @param div the div to activate the tooltips on
 */
function activatehover(div) {
  $('#'+div+' [tooltip]').each(function() // Select all elements with the \"tooltip\" attribute
  {
    $(this).qtip({content: $(this).attr('tooltip')}); // Retrieve the tooltip attribute value from the current element
  });
}

/**
 * Give a human readable format voor de time
 * 
 * $param arg time in seconds
 * @return string representation of time
 */
function parseTime(arg) {
  var myTime = [];
  myTime[0] = ["seconds",1];
  myTime[1] = ["minutes", 60];
  myTime[2] = ["hours",3600];
  myTime[3] = ["days", 86400];
  myTime[4] = ["weeks", 604800];
  myTime[5] = ["months", 2628000];
  myTime[6] = ["years", 31536000];
  var i = 1;
  while(i < 6 && (myTime[(i+1)][1]) < arg) {
    i++;
  }
  var temp = Math.floor(arg / myTime[i][1]);
  var j = i - 1;
  return temp + " " + myTime[i][0] + " " + Math.round((arg - (temp * myTime[i][1])) / myTime[j][1]) + " " + myTime[j][0];
}
