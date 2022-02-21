import { render } from '@testing-library/vue'
import Todo from '../../views/Todo'

const mockTodoList = [
  { id: 1, content: 'Buy alcohol' },
  { id: 2, content: 'Go to mall' }
]

test('renders all todos', () => {
    const { debug } = render(Todo)
})
