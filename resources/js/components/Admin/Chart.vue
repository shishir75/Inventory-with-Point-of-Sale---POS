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
        }
    },
    mounted() {
        this.renderChart(
            {
                labels: this.monthsList,
                datasets: [
                    {
                        label: "Expense",
                        backgroundColor: "#6777EF",
                        data: [10, 9, 20, 22, 5, 50, 12, 10]
                    },
                    {
                        label: "Due",
                        backgroundColor: "#fc544b",
                        data: [20, 19, 30, 10, 19, 5, 29, 16]
                    },
                    {
                        label: "Total Earnings",
                        backgroundColor: "#66bb6a",
                        data: [40, 39, 10, 40, 39, 80, 40, 100]
                    }
                ]
            },
            { responsive: true, maintainAspectRatio: false }
        );
    }
};
</script>
