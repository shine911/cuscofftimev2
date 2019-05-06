import { Bar } from './BaseCharts'
import { reactiveProp } from './mixins'

export default {
    extends: Bar,
    mixins: [reactiveProp],

    mounted () {
        this.renderChart(this.chartData, this.options)
    }
}