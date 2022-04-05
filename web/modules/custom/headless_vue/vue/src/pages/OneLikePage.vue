<template>
  <div>
    <h1>one liek</h1>
    <div class="container border-lg mt-4">
      <div class="row">
        <div class="col-md-6">
          <div class="row card-history">
            <div class="col-md-8">
              <h5 v-html="oneLike.title[0] ? oneLike.title[0].value : ''"></h5>
              <p v-html="oneLike.body[0] ? oneLike.body[0].value : ''"></p>
              <p>
                Crée le
                <span
                  v-html="
                    oneLike.field_date_histoire[0]
                      ? oneLike.field_date_histoire[0].value
                      : ''
                  "
                ></span>
              </p>
            </div>
            <div class="col-md-4">
              <img
                :src="
                  oneLike.field_image_histoire[0]
                    ? oneLike.field_image_histoire[0].url
                    : ''
                "
                alt=""
                class="w-100"
              />
            </div>
          </div>
        </div>
        <div class="col-md-6 text-center">
          <div class="row">
            <div class="col-md-12 text-center">
              <img
                :src="
                  nasafirst.field_image_nasa[0]
                    ? nasafirst.field_image_nasa[0].url
                    : ''
                "
                alt=""
                height="200"
                width="200"
              />
              <div class="d-flex justify-content-between">
                <h5
                  v-html="nasafirst.title[0] ? nasafirst.title[0].value : ''"
                ></h5>
                <p>
                  Crée le
                  <span
                    v-html="
                      nasafirst.created[0] ? nasafirst.created[0].value : ''
                    "
                  ></span>
                </p>
              </div>
              <p v-html="nasafirst.body[0] ? nasafirst.body[0].value : ''"></p>
              <button
                class="w-25 btn btn-success"
                v-if="notAllNasaData"
                @click="loadMoreNasa"
              >
                charger plus
              </button>
            </div>

            <!-- NASA CONTENT -->
            <div class="col-md-12 text-center" v-if="!notAllNasaData">
              <img
                :src="
                  nasaContent.field_image_nasa[0]
                    ? nasaContent.field_image_nasa[0].url
                    : ''
                "
                alt=""
                height="200"
                width="200"
              />
              <div class="d-flex justify-content-between">
                <h5
                  v-html="
                    nasaContent.title[0] ? nasaContent.title[0].value : ''
                  "
                ></h5>
                <p>
                  Crée le
                  <span
                    v-html="
                      nasaContent.created[0] ? nasaContent.created[0].value : ''
                    "
                  ></span>
                </p>
              </div>
              <p
                v-html="nasaContent.body[0] ? nasaContent.body[0].value : ''"
              ></p>
            </div>
          </div>
        </div>
      </div>

      <div>
        <div class="text-right">
          <button class="btn btn-success" @click="printPdf">
            Download PDF
          </button>
        </div>
        <table id="perso-tab">
          <tr>
            <th>Company</th>
            <th>Contact</th>
            <th>Country</th>
          </tr>
          <tr>
            <td>Alfreds Futterkiste</td>
            <td>Maria Anders</td>
            <td>Germany</td>
          </tr>
          <tr>
            <td>Centro comercial Moctezuma</td>
            <td>Francisco Chang</td>
            <td>Mexico</td>
          </tr>
          <tr>
            <td>Ernst Handel</td>
            <td>Roland Mendel</td>
            <td>Austria</td>
          </tr>
          <tr>
            <td>Island Trading</td>
            <td>Helen Bennett</td>
            <td>UK</td>
          </tr>
          <tr>
            <td>Laughing Bacchus Winecellars</td>
            <td>Yoshi Tannamuri</td>
            <td>Canada</td>
          </tr>
          <tr>
            <td>Magazzini Alimentari Riuniti</td>
            <td>Giovanni Rovelli</td>
            <td>Italy</td>
          </tr>
        </table>

        <div id="editor"></div>

      </div>
    </div>
  </div>
</template>

<script>
import html2canvas from "html2canvas";
import jsPDF from "jspdf";
import axios from "../services/index";
import $ from 'jquery'

export default {
  data() {
    return {
      nasafirst: {},
      notAllNasaData: true,
    };
  },
  methods: {
    loadMoreNasa() {
        
      this.$store.dispatch("LoadNasaContent");
      this.notAllNasaData = false;
    },

    printPdf() {
       var seePdf = document.getElementById("perso-tab");
    //     // console.log("voir seePDF", seePdf)
    //     var wme = window.open("","","width=1200,height=700");
    //     wme.document.write(seePdf);
    //     wme.document.close();
    //     wme.focus();
    //     wme.print();
    //     wme.close();
        html2canvas(seePdf, {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("cutomer-details.pdf");
                }
            });
        

    },
  },
  computed: {
    oneLike() {
      return this.$store.state.historyOnePage;
    },
    nasaContent() {
      return this.$store.state.nasaContent.pop();
    },
  },
  mounted() {
    axios
      .get("/api/nasa?_format=json")
      .then((res) => res.data)
      .then((res) => {
        this.nasafirst = res[0];
        console.log("GET NASA ", this.nasafirst);
      });
  },
};
</script>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td,
th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>