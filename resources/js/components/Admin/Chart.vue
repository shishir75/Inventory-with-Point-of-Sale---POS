<script>
import VueCharts from "vue-chartjs";

export default {
    extends: VueCharts.Line,
    created() {
        this.$store.dispatch("getAllTodayHistory");
    },
    computed: {
        todayHistory() {
            return this.$store.getters.getAllTodayHistory;
        },
        monthsList() {
            let arr = [];
            this.todayHistory.months.forEach((value, index) => {
                arr.push(value.month);
            });
            return arr;
        },
        monthlyTotal() {
            let arr = [];
            this.todayHistory.monthly_total.forEach((value, index) => {
                arr.push(value.total);
            });
            return arr;
        },
        monthlyDue() {
            let arr = [];
            this.todayHistory.monthly_due.forEach((value, index) => {
                arr.push(value.due);
            });
            return arr;
        }
    },
    mounted() {
        this.renderChart(
            {
                labels: this.monthsList,
                datasets: [
                    {
                        label: "Due",
                        backgroundColor: "#fc544b",
                        data: this.monthlyDue
                    },
                    {
                        label: "Total Sales",
                        backgroundColor: "#66bb6a",
                        data: this.monthlyTotal
                    }
                ]
            },
            { responsive: true, maintainAspectRatio: false }
        );
    }
};
</script>
