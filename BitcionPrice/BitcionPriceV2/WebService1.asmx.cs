using Newtonsoft.Json;
using System;
using System.Net;
using System.Web.Services;

namespace BitcionPriceV2
{
    /// <summary>
    /// Summary description for WebService1
    /// </summary>
    [WebService(Namespace = "http://tempuri.org/")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]
    // To allow this Web Service to be called from script, using ASP.NET AJAX, uncomment the following line. 
    // [System.Web.Script.Services.ScriptService]
    public class WebService1 : System.Web.Services.WebService
    {

        [WebMethod]
        public string test()
        {
            return "Test workt.";
        }

        [WebMethod]
        public string help()
        {
            //return Redirect("http://www.example.com");
            System.Web.HttpContext.Current.Response.Redirect("https://documenter.getpostman.com/view/7126087/SVfQPnyK?version=latest");
            return "Ok .";
        }

        [WebMethod]
        public string BTCinfo()
        {


            string json = new WebClient().DownloadString("https://api.coindesk.com/v1/bpi/currentprice.json");

            return json;
        }


        [WebMethod]
        public string BTCPrice()
        {

            // source https://stackoverflow.com/questions/9202411/convert-tostring-not-handling-null

            string json = new WebClient().DownloadString("https://api.coindesk.com/v1/bpi/currentprice.json");
            dynamic rss = JsonConvert.DeserializeObject(json);
            string price = Convert.ToString(rss["bpi"]["EUR"]["rate"]);

            return price;
        }



    }
}
